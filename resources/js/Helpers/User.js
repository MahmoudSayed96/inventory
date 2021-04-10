import Token from './Token';
import AppStorage from './AppStorage';

class User {

    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const username = res.data.name;
        // Check token validation.
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, username);
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }
    }

    isLoggedIn() {
        return this.hasToken();
    }

    name() {
        if (this.isLoggedIn()) {
            return AppStorage.getUser();
        } 
    }

    id() {
        if (this.isLoggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        } 

        return false;
    }
}

export default User = new User();