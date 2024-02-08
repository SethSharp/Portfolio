import { computed, onMounted } from 'vue'

export default function (props, ignoredProps = ['id']) {
    const defaultAttributes = props.node.type.defaultAttrs || {}

    return Object.keys(props.node.attrs).reduce((carry, prop) => {
        if (!ignoredProps.includes(prop)) {
            carry[prop] = computed({
                get: () => props.node.attrs[prop],
                set: (value) => {
                    props.updateAttributes({
                        [prop]: value,
                    })
                },
            })

            onMounted(() => {
                if (
                    Array.isArray(defaultAttributes[prop]) &&
                    typeof carry[prop].value === 'string'
                ) {
                    if (carry[prop].value === '') {
                        carry[prop].value = []
                    } else {
                        carry[prop].value = carry[prop].value.split(',')
                    }
                }
            })
        }

        return carry
    }, {})
}
