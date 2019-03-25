_ = require('lodash');
import Song from './config/song';

let base_config = {

};

let config = _.merge(base_config, Song);

export default config;