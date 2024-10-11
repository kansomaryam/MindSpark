// financial-block.js
const { registerBlockType } = wp.blocks;

registerBlockType('aquila/financial-block', {
    title: 'Financial Block',
    icon: 'money',
    category: 'widgets',
    attributes: {
        amount: {
            type: 'string',
            default: '0'
        }
    },
    edit: (props) => {
        const { attributes, setAttributes } = props;

        return ( <
            div >
            <
            input type = "text"
            value = { attributes.amount }
            onChange = {
                (e) => setAttributes({ amount: e.target.value }) }
            /> <
            p > Current Amount: { attributes.amount } < /p> <
            /div>
        );
    },
    save: (props) => {
        return <p > { props.attributes.amount } < /p>;
    }
});