import { AppConfig } from '../../app.config';

const ACCOUNT_GATEWAY_URL = AppConfig.GATEWAY_API + '/admin';

export class AccountConfig {
    public static ACCOUNT_API_URL: string = ACCOUNT_GATEWAY_URL + '/user';
}