/**
 * WordPress dependencies
 */
import { useDispatch } from "@wordpress/data";
import { BlockControls } from "@wordpress/block-editor";
import { ToolbarButton } from "@wordpress/components";
import { createHigherOrderComponent } from "@wordpress/compose";
import { addFilter } from "@wordpress/hooks";
import { createElement as el, Fragment } from "@wordpress/element";

/**
 * Add delete button to block editor
 * 
 * @param {Function} BlockEdit Block edit component
 * @returns {Function} Block edit component
 */
const withDelete = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const { removeBlock } = useDispatch('core/block-editor');
        const { clientId, attributes: { lock } } = props;

        if (lock?.remove) return el(BlockEdit, props);

        return el(
            Fragment,
            null,
            el(BlockEdit, props),
            el(BlockControls, { group: 'block' },
                el(ToolbarButton, {
                    icon: 'trash',
                    label: 'Delete',
                    isDestructive: true,
                    onClick: () => removeBlock(clientId),
                })
            )
        );
    };
}, 'withDelete');

/**
 * Add delete button filter
 * 
 * @return {void} The function applies the filter
 */
const addDeleteButtonFilter = () => {
    addFilter(
        'editor.BlockEdit',
        'Firework/delete-control-by-firework',
        withDelete
    );
};

addDeleteButtonFilter();
