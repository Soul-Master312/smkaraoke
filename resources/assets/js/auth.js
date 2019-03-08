_ = require('lodash');

let auth = {
    user: {},
    status: false,
    token: '',
    role: '',
    loggedIn: () => {
        return this.status;
    },
    login: (auth) => {
        if (auth) {
            _.merge(this, auth);
            this.status = true;
        }
    },
    logout: () => {
        this.status = false
        this.reset();
    },
    reset: () => {
        this.user = {};
        this.token = '';
        this.role = '';
    }
};

export default auth