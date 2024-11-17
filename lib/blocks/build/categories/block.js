(function (blocks, i18n, element, editor, components) {
    let __ = i18n.__;
    let category = "rc-dcg-blocks";
    let el = element.createElement;
    let SelectControl = components.SelectControl;

    blocks.registerBlockType("rc-dcg/categories", {
        title: __("Categories Grid", "rc-dcg"),
        description: __("Display categories in a grid with images", "rc-dcg"),
        icon: "screenoptions",
        category: category,

        edit({ attributes, setAttributes }) {
            return el(
                "div",
                editor.useBlockProps(),
                el(
                    "h4",
                    { className: "rc-dcg-block-editor-title" },
                    __("Categories grid", "rc-dcg")
                ),
                el(
                    "div",
                    {
                        className: "rc-dcg-block-editor-wrap",
                    },
                    el(SelectControl, {
                        label: __("Select which one to display", "rc-dcg"),
                        value: attributes.option,
                        options: [
                            {
                                label: __("Post Categories", "rc-dcg"),
                                value: "category",
                            },
                            {
                                label: __("Post Tags", "rc-dcg"),
                                value: "post_tag",
                            },
                            {
                                label: __("Woo Product Categories", "rc-dcg"),
                                value: "product_cat",
                            },
                            {
                                label: __("Woo Product Tags", "rc-dcg"),
                                value: "product_tag",
                            },
                        ],
                        onChange: (value) => {
                            setAttributes({ option: value });
                        },
                    })
                )
            );
        },
        save: () => {
            return null;
        },
    });
})(
    window.wp.blocks,
    window.wp.i18n,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components
);
