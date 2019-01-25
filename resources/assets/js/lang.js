export default {
    methods: {
        trans(string) {
            console.log(string);
            return window._.get(window.trans, string);
        },
    },
};