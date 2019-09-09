(function ($) {

    'use strict';


    var MasterAddonsData = window.MasterAddonsData || {},
        MasterEditor,
        MasterEditorViews,
        MasterControlViews,
        MasterModules;

    MasterEditorViews = {
        ModalLayoutView: null,
        ModalHeaderView: null,
        ModalHeaderInsertButton: null,
        ModalLoadingView: null,
        ModalBodyView: null,
        ModalErrorView: null,
        LibraryCollection: null,
        KeywordsModel: null,
        ModalCollectionView: null,
        ModalTabsCollection: null,
        ModalTabsCollectionView: null,
        FiltersCollectionView: null,
        FiltersItemView: null,
        ModalTabsItemView: null,
        ModalTemplateItemView: null,
        ModalInsertTemplateBehavior: null,
        ModalTemplateModel: null,
        CategoriesCollection: null,
        ModalPreviewView: null,
        ModalHeaderBack: null,
        ModalHeaderLogo: null,
        MasterProButton: null,
        KeywordsView: null,
        TabModel: null,
        CategoryModel: null,

        init: function () {
            let me = this;

            me.ModalTemplateModel = Backbone.Model.extend({
                defaults:{
                    template_id: 0,
                    name: '',
                    title: '',
                    thumbnail: '',
                    preview: '',
                    source: '',
                    categories: [],
                    keywords: [],
                    liveUrl: '',
                    package: '',
                }
            });

            me.ModalHeaderView = Marionette.LayoutView.extend({
                id: 'ma-el-template-modal-header',
                template: '#views-ma-el-template-modal-header',
                ui:{
                    closeModal: '#ma-el-template-modal-header-close-modal'
                },
                events:{
                    'click @ui.closeModal': 'onCloseModalClick'
                },
                regions:{
                    headerLogo: '#ma-el-template-modal-header-logo-area',
                    headerTabs: '#ma-el-template-modal-header-tabs',
                    headerActions: '#ma-el-template-modal-header-actions'
                },
                onCloseModalClick: function () {
                    MasterEditor.closeModal()
                }
            });

            me.TabModel = Backbone.Model.extend({
               defaults: {
                   slug: '',
                   title: ''
               }
            });

            me.LibraryCollection = Backbone.Collection.extend({
               model: me.ModalTemplateModel
            });

            me.ModalTabsCollection = Backbone.Collection.extend({
               model: me.TabModel
            });

            me.CategoryModel = Backbone.Model.extend({
               defaults:{
                   slug:'',
                   title:''
               }
            });

            me.KeywordsModel = Backbone.Model.extend({
               defaults: {
                   keywords:{}
               }
            });

            me.CategoriesCollection = Backbone.Collection.extend({
                model: me.CategoryModel
            });

            //Commented
            me.KeywordsView = Marionette.ItemView.extend({
                id: 'elementor-template-library-filter',
                template: '#views-ma-el-template-modal-keywords',
                ui:{
                    keywords: '.ma-el-library-keywords'
                },
                events:{
                    'change @ui.keywords' : 'onSelectKeyword'
                },
                onSelectKeyword: function (event) {
                    var selected = event.currentTarget.selectedOptions[0].value;
                    MasterEditor.setFilter('keyword', selected);
                },
                onRender: function(){
                    var $filters = this.$('.ma-el-library-keywords');
                    $filters.select2({
                        placeholder: "Choose a Widget",
                        allowClear: true,
                        width: 260
                    });
                }
            });

            me.ModalPreviewView = Marionette.ItemView.extend({
                template: '#views-ma-el-template-modal-preview',
                id: 'ma-el-item-preview-wrap',
                ui:{
                    iframe: 'iframe',
                    notice: '.ma-el-item-notice',
                    // img: 'img'
                },
                // onRender: function(){
                //     // if(null !=)
                //     this.ui.img.attr('src', me.getOption('preview'))
                // },

                onRender: function () {

                    if (null !== this.getOption('notice')) {
                        if (this.getOption('notice').length) {
                            var message = "";
                            if (-1 !== this.getOption('notice').indexOf("facebook")) {
                                message += "<p>Please login with your Facebook account in order to get your Facebook Reviews.</p>";
                            } else if (-1 !== this.getOption('notice').indexOf("google")) {
                                message += "<p>You need to add your Google API key from Dashboard -> Premium Add-ons for Elementor -> Google Maps</p>";
                            } else if (-1 !== this.getOption('notice').indexOf("form")) {
                                message += "<p>You need to have <a href='https://wordpress.org/plugins/contact-form-7/' target='_blank'>Contact Form 7 plugin</a> installed and active.</p>";
                            }

                            this.ui.notice.html('<div><p><strong>Important!</strong></p>' + message + '</div>');
                        }
                    }

                    this.ui.iframe.attr('src', this.getOption('url'));

                }



            });

            me.ModalHeaderBack = Marionette.ItemView.extend({
                template: '#views-ma-el-template-modal-header-back',
                id: 'ma-el-template-modal-header-back',
                ui: {
                    button: 'button'
                },
                events: {
                    'click @ui.button': 'onBackClick'
                },
                onBackClick: function () {
                    MasterEditor.setPreview('back');
                }
            });

            me.ModalHeaderLogo = Marionette.ItemView.extend({
                template: '#views-ma-el-template-modal-header-logo',
                id: 'ma-el-template-modal-header-logo'
            });

            me.ModalBodyView = Marionette.LayoutView.extend({
                template: '#views-ma-el-template-modal-content',
                id: 'ma-el-template-library-content',
                className: function () {
                    return 'library-tab-' + MasterEditor.getTab();
                },
                regions:{
                    contentTemplates: '.ma-el-templates-list',
                    contentFilters: '.ma-el-filters-list',
                    contentKeywords: '.ma-el-keywords-list'
                }

            });

            me.LibraryLoadingView = Marionette.ItemView.extend({
                id: 'ma-el-modal-template-library-loading',
                template: '#views-ma-el-template-modal-library-loading-view'
            });

            me.LibraryErrorView = Marionette.ItemView.extend({
                id: 'ma-el-modal-template-library-error',
                template: '#views-ma-el-template-modal-library-error-view'
            });



            me.ModalInsertTemplateBehavior = Marionette.Behavior.extend({
                ui: {
                    insertButton: '.ma-el-template-insert'
                },

                events: {
                    'click @ui.insertButton': 'onInsertButtonClick'
                },

                onInsertButtonClick: function () {


                    console.log( 'Insert Clicked' );

                    var templateModel = this.view.model,
                        innerTemplates = templateModel.attributes.dependencies,
                        isPro = templateModel.attributes.pro,
                        innerTemplatesLength = Object.keys(innerTemplates).length,
                        options = {};
                    //
                    // console.log( ' Template Model:' + templateModel );
                    // console.log( ' innerTemplates:' + innerTemplates );
                    // console.log( ' isPro:' + isPro );
                    // console.log( ' innerTemplatesLength:' + innerTemplatesLength );
                    // console.log( ' options:' + options );
                    //

                    MasterEditor.layout.showLoadingView();


                    if (innerTemplatesLength > 0) {

                        for (var key in innerTemplates) {

                            $.ajax({
                                url: ajaxurl,
                                type: 'post',
                                dataType: 'json',
                                data: {
                                    action: 'ma_el_inner_template',
                                    template: innerTemplates[key],
                                    tab: MasterEditor.getTab()
                                }
                            });
                        }
                    }

                    if ("valid" === MasterAddonsData.license.status || ! isPro ) {

                        elementor.templates.requestTemplateContent(
                            templateModel.get('source'),
                            templateModel.get('template_id'),
                            {
                                data: {
                                    tab: MasterEditor.getTab(),
                                    page_settings: false
                                },
                                success: function (data) {

                                    // console.log(data);

                                    //
                                    // if ( ! data.license ) {
                                    //     MasterEditor.layout.showLicenseError();
                                    //     return;
                                    // }

                                    console.log("%c Template Inserted Successfully!!", "color: #7a7a7a; background-color: #eee;");

                                    MasterEditor.closeModal();

                                    elementor.channels.data.trigger('template:before:insert', templateModel);

                                    if (null !== MasterEditor.atIndex) {
                                        options.at = MasterEditor.atIndex;
                                    }

                                    elementor.sections.currentView.addChildModel(data.content, options);

                                    elementor.channels.data.trigger('template:after:insert', templateModel);

                                    MasterEditor.atIndex = null;

                                },
                                error: function (err) {
                                    console.log(err);
                                }
                            }
                        );

                    } else {
                        MasterEditor.layout.showLicenseError();
                    }


                }
            });


            me.ModalHeaderInsertButton = Marionette.ItemView.extend({
                template: '#views-ma-el-template-modal-insert-button',
                id: 'ma-el-template-modal-insert-button',
                behaviors:{
                    insertTemplate:{
                        behaviorClass: me.ModalInsertTemplateBehavior
                    }
                }
            });

            me.MasterProButton = Marionette.ItemView.extend({
                template: '#views-ma-el-template-pro-button',
                id: 'ma-el-modal-template-pro-button',
            });


            me.ModalTemplateItemView = Marionette.ItemView.extend({

                template: '#views-ma-el-template-modal-item',

                className: function () {

                    var urlClass = ' ma-el-modal-template-has-url',
                        sourceClass = ' elementor-template-library-template-',
                        proTemplate = '';

                    if ('' === this.model.get('preview')) {
                        urlClass = ' ma-el-modal-template-no-url';
                    }

                    sourceClass += 'remote';

                    if (this.model.get('pro')) {
                        proTemplate = ' ma-el-modal-template-pro';
                    }

                    return 'elementor-template-library-template' + sourceClass + urlClass + proTemplate;
                },

                ui: function () {
                    return {
                        previewButton: '.elementor-template-library-template-preview',
                    };
                },

                events: function () {
                    return {
                        'click @ui.previewButton': 'onPreviewButtonClick',
                    };
                },

                onPreviewButtonClick: function () {

                    if ('' === this.model.get('url')) {
                        return;
                    }

                    MasterEditor.setPreview(this.model);
                },

                behaviors: {
                    insertTemplate: {
                        behaviorClass: me.ModalInsertTemplateBehavior
                    }
                }
            });

            me.FiltersItemView = Marionette.ItemView.extend({

                template: '#views-ma-el-template-modal-filters-item',

                className: function () {
                    return 'ma-el-modal-template-filter-item';
                },

                ui: function () {
                    return {
                        filterLabels: '.ma-el-modal-template-filter-label'
                    };
                },

                events: function () {
                    return {
                        'click @ui.filterLabels': 'onFilterClick'
                    };
                },

                onFilterClick: function (event) {

                    var $clickedInput = jQuery(event.target);
                    jQuery('.ma-el-library-keywords').val('');
                    MasterEditor.setFilter('category', $clickedInput.val());
                    MasterEditor.setFilter('keyword', '');

                    // var $clickedInput = jQuery(t.target);
                    // MasterEditor.setFilter('category', $clickedInput.val())
                }

            });



            me.ModalTabsItemView = Marionette.ItemView.extend({

                template: '#views-ma-el-template-modal-tabs-item',

                className: function () {
                    return 'elementor-template-library-menu-item';
                },

                ui: function () {
                    return {
                        tabsLabels: 'label',
                        tabsInput: 'input'
                    };
                },

                events: function () {
                    return {
                        'click @ui.tabsLabels': 'onTabClick'
                    };
                },

                onRender: function () {
                    if (this.model.get('slug') === MasterEditor.getTab()) {
                        this.ui.tabsInput.attr('checked', 'checked');
                    }
                },

                onTabClick: function (event) {

                    var $clickedInput = jQuery(event.target);
                    MasterEditor.setTab($clickedInput.val());
                    MasterEditor.setFilter('keyword', '');
                }

            });



            me.FiltersCollectionView = Marionette.CompositeView.extend({

                id: 'ma-el-modal-template-library-filters',

                template: '#views-ma-el-template-modal-filters',

                childViewContainer: '#ma-el-modal-filters-container',

                getChildView: function (childModel) {
                    return me.FiltersItemView;
                }

            });


            me.ModalTabsCollectionView = Marionette.CompositeView.extend({

                template: '#views-ma-el-template-modal-tabs',

                childViewContainer: '#views-ma-el-template-modal-tabs-items',

                initialize: function () {
                    this.listenTo(MasterEditor.channels.layout, 'tamplate:cloned', this._renderChildren);
                },

                getChildView: function (childModel) {
                    return me.ModalTabsItemView;
                }

            });




            me.ModalCollectionView = Marionette.CompositeView.extend({

                template: '#views-ma-el-template-modal-templates',

                id: 'ma-el-modal-template-library-templates',

                childViewContainer: '#ma-el-modal-templates-container',

                initialize: function () {

                    this.listenTo(MasterEditor.channels.templates, 'filter:change', this._renderChildren);
                },

                filter: function (childModel) {

                    var filter = MasterEditor.getFilter('category'),
                        keyword = MasterEditor.getFilter('keyword');

                    if (!filter && !keyword) {
                        return true;
                    }

                    if (keyword && !filter) {
                        return _.contains(childModel.get('keywords'), keyword);
                    }

                    if (filter && !keyword) {
                        return _.contains(childModel.get('categories'), filter);
                    }

                    return _.contains(childModel.get('categories'), filter) && _.contains(childModel.get('keywords'), keyword);

                },

                getChildView: function (childModel) {
                    return me.ModalTemplateItemView;
                },

                onRenderCollection: function () {

                    var container = this.$childViewContainer,
                        items = this.$childViewContainer.children(),
                        tab = MasterEditor.getTab();

                    if ('premium_page' === tab || 'local' === tab) {
                        return;
                    }

                    // Wait for thumbnails to be loaded
                    container.imagesLoaded(function () {}).done(function () {

                        // me.masonry.init({
                        //     container: container,
                        //     items: items
                        // });

                        setTimeout(function() {
                            me.masonry.init({
                                container: container,
                                items: items
                            })
                        }, 200);

                    });


                }

            });

            me.ModalLoadingView = Marionette.ItemView.extend({
                id: 'ma-el-modal-loading',
                template: '#views-ma-el-template-modal-loading'
            });

            me.ModalErrorView = Marionette.ItemView.extend({
                id: 'ma-el-modal-loading',
                template: '#views-ma-el-template-modal-error'
            });


            me.ModalLayoutView = Marionette.LayoutView.extend({

                el: '#tmpl-ma-el-modal-template',

                regions: MasterAddonsData.modalRegions,

                initialize: function () {

                    this.getRegion('modalHeader').show(new me.ModalHeaderView());
                    this.listenTo(MasterEditor.channels.tabs, 'filter:change', this.switchTabs);
                    this.listenTo(MasterEditor.channels.layout, 'preview:change', this.switchPreview);

                },

                switchTabs: function () {
                    this.showLoadingView();
                    MasterEditor.setFilter('keyword', '');
                    MasterEditor.requestTemplates(MasterEditor.getTab());
                },

                switchPreview: function () {

                    var header = this.getHeaderView(),
                        preview = MasterEditor.getPreview();

                    var filter = MasterEditor.getFilter('category'),
                        keyword = MasterEditor.getFilter('keyword');

                    if ('back' === preview) {
                        header.headerLogo.show(new me.ModalHeaderLogo());
                        header.headerTabs.show(new me.ModalTabsCollectionView({
                            collection: MasterEditor.collections.tabs
                        }));

                        header.headerActions.empty();
                        MasterEditor.setTab(MasterEditor.getTab());

                        if( '' != filter ) {
                            MasterEditor.setFilter( 'category', filter );
                            jQuery('#ma-el-modal-filters-container').find("input[value='" + filter + "']").prop('checked', true);

                        }

                        if( '' != keyword ) {
                            MasterEditor.setFilter('keyword', keyword);
                        }

                        return;
                    }

                    if ('initial' === preview) {
                        header.headerActions.empty();
                        header.headerLogo.show(new me.ModalHeaderLogo());
                        return;
                    }

                    this.getRegion('modalContent').show(new me.ModalPreviewView({
                        'preview': preview.get('preview'),
                        'url': preview.get('url'),
                        'notice': preview.get('notice')
                    }));

                    header.headerLogo.empty();
                    header.headerTabs.show(new me.ModalHeaderBack());
                    header.headerActions.show(new me.ModalHeaderInsertButton({
                        model: preview
                    }));

                },

                getHeaderView: function () {
                    return this.getRegion('modalHeader').currentView;
                },

                getContentView: function () {
                    return this.getRegion('modalContent').currentView;
                },

                showLoadingView: function () {
                    this.modalContent.show(new me.ModalLoadingView());
                },

                showLicenseError: function () {
                    this.modalContent.show(new me.ModalErrorView());
                },

                showTemplatesView: function (templatesCollection, categoriesCollection, keywords) {

                    this.getRegion('modalContent').show(new me.ModalBodyView());

                    var contentView = this.getContentView(),
                        header = this.getHeaderView(),
                        keywordsModel = new me.KeywordsModel({
                            keywords: keywords
                        });

                    MasterEditor.collections.tabs = new me.ModalTabsCollection(MasterEditor.getTabs());

                    header.headerTabs.show(new me.ModalTabsCollectionView({
                        collection: MasterEditor.collections.tabs
                    }));

                    contentView.contentTemplates.show(new me.ModalCollectionView({
                        collection: templatesCollection
                    }));

                    contentView.contentFilters.show(new me.FiltersCollectionView({
                        collection: categoriesCollection
                    }));

                    contentView.contentKeywords.show(new me.KeywordsView({
                        model: keywordsModel
                    }));

                }

            });




        },

        masonry:{

            self:{},
            elements: {},
            init: function (settings) {
                var me = this;
                me.settings = $.extend(me.getDefaultSettings(), settings);
                me.elements = me.getDefaultElements();

                me.run();
            },
            getSettings: function (key) {
                if (key) {
                    return this.settings[key];
                } else {
                    return this.settings;
                }
            },
            getDefaultSettings: function () {
                return {
                    container: null,
                    items: null,
                    columnsCount: 3,
                    verticalSpaceBetween: 30
                };
            },
            getDefaultElements: function () {
                return {
                    $container: jQuery(this.getSettings('container')),
                    $items: jQuery(this.getSettings('items'))
                };
            },

            run: function () {
                var heights = [],
                    distanceFromTop = this.elements.$container.position().top,
                    settings = this.getSettings(),
                    columnsCount = settings.columnsCount;

                distanceFromTop += parseInt(this.elements.$container.css('margin-top'), 10);

                this.elements.$container.height('');

                this.elements.$items.each(function (index) {
                    var row = Math.floor(index / columnsCount),
                        indexAtRow = index % columnsCount,
                        $item = jQuery(this),
                        itemPosition = $item.position(),
                        itemHeight = $item[0].getBoundingClientRect().height + settings.verticalSpaceBetween;

                    if (row) {
                        var pullHeight = itemPosition.top - distanceFromTop - heights[indexAtRow];
                        pullHeight -= parseInt($item.css('margin-top'), 10);
                        pullHeight *= -1;
                        $item.css('margin-top', pullHeight + 'px');
                        heights[indexAtRow] += itemHeight;
                    } else {
                        heights.push(itemHeight);
                    }
                });

                this.elements.$container.height(Math.max.apply(Math, heights));
            }
        } // End of Masonry



    };


    MasterControlViews ={
        MasterSearchView: null,

        init: function () {

            var me = this;

            me.MasterSearchView = window.elementor.modules.controls.BaseData.extend({

                onReady: function () {

                    var action = this.model.attributes.action,
                        queryParams = this.model.attributes.query_params;

                    this.ui.select.find('option').each(function (index, el) {
                        $(this).attr('selected', true);
                    });

                    this.ui.select.select2({
                        ajax: {
                            url: function () {

                                var query = '';

                                if (queryParams.length > 0) {
                                    $.each(queryParams, function (index, param) {

                                        if (window.elementor.settings.page.model.attributes[param]) {
                                            query += '&' + param + '=' + window.elementor.settings.page.model.attributes[param];
                                        }
                                    });
                                }

                                return ajaxurl + '?action=' + action + query;
                            },
                            dataType: 'json'
                        },
                        placeholder: 'Please enter 3 or more characters',
                        minimumInputLength: 3
                    });

                },

                onBeforeDestroy: function () {

                    if (this.ui.select.data('select2')) {
                        this.ui.select.select2('destroy');
                    }

                    this.$el.remove();
                }

            });

            window.elementor.addControlView('premium_search', me.MasterSearchView);

        }

    };



    MasterModules = {

        getDataToSave: function (data) {
            data.id = window.elementor.config.post_id;
            return data;
        },

        init: function () {
            if (window.elementor.settings.premium_template) {
                window.elementor.settings.premium_template.getDataToSave = this.getDataToSave;
            }

            if (window.elementor.settings.premium_page) {
                window.elementor.settings.premium_page.getDataToSave = this.getDataToSave;
                window.elementor.settings.premium_page.changeCallbacks = {
                    custom_header: function () {
                        this.save(function () {
                            elementor.reloadPreview();

                            elementor.once('preview:loaded', function () {
                                elementor.getPanelView().setPage('premium_page_settings');
                            });
                        });
                    },
                    custom_footer: function () {
                        this.save(function () {
                            elementor.reloadPreview();

                            elementor.once('preview:loaded', function () {
                                elementor.getPanelView().setPage('premium_page_settings');
                            });
                        });
                    }
                };
            }

        }

    };


    MasterEditor = {

        modal: false,
        layout: false,
        collections: {},
        tabs: {},
        defaultTab: '',
        channels: {},
        atIndex: null,

        init: function () {

            window.elementor.on(
                'preview:loaded',
                window._.bind(MasterEditor.onPreviewLoaded, MasterEditor)
            );

            MasterEditorViews.init();
            MasterControlViews.init();
            MasterModules.init();

        },

        onPreviewLoaded: function () {

            this.initMasterTempsButton();

            window.elementor.$previewContents.on(
                'click.addMasterTemplate',
                '.ma-el-add-section-btn',
                _.bind(this.showTemplatesModal, this)
            );

            this.channels = {
                templates: Backbone.Radio.channel('MASTER_EDITOR:templates'),
                tabs: Backbone.Radio.channel('MASTER_EDITOR:tabs'),
                layout: Backbone.Radio.channel('MASTER_EDITOR:layout'),
            };

            this.tabs = MasterAddonsData.tabs;
            this.defaultTab = MasterAddonsData.defaultTab;

        },

        initMasterTempsButton: function () {


            var $addNewSection = window.elementor.$previewContents.find('.elementor-add-new-section'),
                addMasterTemplate = "<div class='elementor-add-section-area-button ma-el-add-section-btn' title='Add" +
                    " Master Addons" +
                    " Template'><i class='fas fa-home'></i></div>",
                $addMasterTemplate;

            if ($addNewSection.length && MasterAddonsData.MasterAddonsEditorBtn) {

                $addMasterTemplate = $(addMasterTemplate).prependTo($addNewSection);
            }

            window.elementor.$previewContents.on(
                'click.addMasterTemplate',
                '.elementor-editor-section-settings .elementor-editor-element-add',
                function () {

                    var $this = $(this),
                        $section = $this.closest('.elementor-top-section'),
                        modelID = $section.data('model-cid');

                    if (window.elementor.sections.currentView.collection.length) {
                        $.each(window.elementor.sections.currentView.collection.models, function (index, model) {
                            if (modelID === model.cid) {
                                MasterEditor.atIndex = index;
                            }
                        });
                    }

                    if (MasterAddonsData.MasterAddonsEditorBtn) {
                        setTimeout(function () {
                            var $addNew = $section.prev('.elementor-add-section').find('.elementor-add-new-section');
                            $addNew.prepend(addMasterTemplate);
                        }, 100);
                    }

                }
            );
        },

        getFilter: function (name) {

            return this.channels.templates.request('filter:' + name);
        },

        setFilter: function (name, value) {
            this.channels.templates.reply('filter:' + name, value);
            this.channels.templates.trigger('filter:change');
        },

        getTab: function () {
            return this.channels.tabs.request('filter:tabs');
        },

        setTab: function (value, silent) {

            this.channels.tabs.reply('filter:tabs', value);

            if (!silent) {
                this.channels.tabs.trigger('filter:change');
            }

        },

        getTabs: function () {

            var tabs = [];

            _.each(this.tabs, function (item, slug) {
                tabs.push({
                    slug: slug,
                    title: item.title
                });
            });

            return tabs;
        },

        getPreview: function (name) {
            return this.channels.layout.request('preview');
        },

        setPreview: function (value, silent) {

            this.channels.layout.reply('preview', value);

            if (!silent) {
                this.channels.layout.trigger('preview:change');
            }
        },

        getKeywords: function () {

            var keywords = [];

            _.each(this.keywords, function (title, slug) {
                tabs.push({
                    slug: slug,
                    title: title
                });
            });

            return keywords;
        },

        showTemplatesModal: function () {

            this.getModal().show();

            if (!this.layout) {
                this.layout = new MasterEditorViews.ModalLayoutView();
                this.layout.showLoadingView();
            }

            this.setTab(this.defaultTab, true);
            this.requestTemplates(this.defaultTab);
            this.setPreview('initial');

        },

        requestTemplates: function (tabName) {

            var self = this,
                tab = self.tabs[tabName];

            self.setFilter('category', false);

            if (tab.data.templates && tab.data.categories) {
                self.layout.showTemplatesView(tab.data.templates, tab.data.categories, tab.data.keywords);
            } else {
                $.ajax({
                    url: ajaxurl,
                    type: 'get',
                    dataType: 'json',
                    data: {
                        action: 'ma_el_get_templates',
                        tab: tabName
                    },
                    success: function (response) {

                        console.log(response);

                        console.log("%cTemplates Retrieved Successfully!!", "color: #7a7a7a; background-color: #eee;");

                        var templates = new MasterEditorViews.LibraryCollection(response.data.templates),
                            categories = new MasterEditorViews.CategoriesCollection(response.data.categories);

                        self.tabs[tabName].data = {
                            templates: templates,
                            categories: categories,
                            keywords: response.data.keywords
                        };

                        self.layout.showTemplatesView(templates, categories, response.data.keywords);

                    }
                });
            }

        },

        closeModal: function () {
            this.getModal().hide();
        },

        getModal: function () {

            if (!this.modal) {
                this.modal = elementor.dialogsManager.createWidget('lightbox', {
                    id: 'ma-el-modal-template',
                    className: 'elementor-templates-modal',
                    closeButton: false
                });
            }

            return this.modal;

        }

    };


    $(window).on('elementor:init', MasterEditor.init);


})(jQuery);