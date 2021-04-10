import { upperCase } from "lodash";

const env = {
    'APP_URL' : 'https://vpos.test',
};

function getEnv(prop) {
    return env[upperCase(prop)];
}

export {getEnv};