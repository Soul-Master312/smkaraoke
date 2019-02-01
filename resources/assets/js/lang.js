export default {
    methods: {
        trans(string) {
            return window._.get(window.trans, string);
        },
    },
};