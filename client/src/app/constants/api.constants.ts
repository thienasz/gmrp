import { environment } from 'environments/environment';

// export const DEV_HOST = location.hostname;
// export const PROD_HOST = location.hostname;
// export const DEV_PORT = location.hostname;
// export const PROD_PORT = location.hostname;

// export const HOST = (environment.production ? DEV_HOST : PROD_HOST);
// export const PORT = (environment.production ? DEV_PORT : PROD_PORT);

// export const API_URL = '//' + HOST + ':' + PORT;

export const API = {
  auth: {
    login: '',
    logout: '',
    refreshToken: '',
    checkToken: ''
  }
};

export const PORT = 8000;
export const HOST = '//' + location.hostname + ':' + PORT + '/server/';

export const MENU = {
  NORMAL_MENU: HOST + 'public/api/menu',
  MAIN_MENU: HOST + 'public/api/parent-menu'
};

export const SLIDE = {
  GET_SLIDE: HOST + 'public/api/slide',
  CHANG_STT_SLIDE: HOST + '/slide/change-status/'
};

export const HOT_PRODUCT = HOST + 'public/api/hot-product';

export const SEARCH_PRODUCT = HOST + 'public/api/search';

export const BRANCH = {
  GET_BRANCH: HOST + 'public/api/branch',
  GET_BY_CITY: HOST + 'public/api/branch/city/'
};

export const GET_PRODUCT_BY_CATEGORY = HOST + 'public/api/product/category/';

export const PRODUCT = HOST + 'public/api/product';

export const THANH_TOAN = HOST + 'public/api/cart';

export const POST = HOST + '/public/api/post';

export const RECRUITMENT = HOST + 'public/api/recruitment';

export const RATING = HOST + 'public/api/rating';

export const LIKE_PRODUCT = HOST + 'public/api/like';

export const LIKED_PRODUCT = HOST + 'public/api/liked-product';

export const PROFILE = HOST + 'public/api/userdetails';

export const PRODUCT_IMAGE = HOST + 'public/api/product-image/';

export const CART_PRODUCT = HOST + 'public/api/cart';

export const CHECK_OUT_DISCOUNT = HOST + 'public/api/discount-code/';

export const LOGIN = HOST + 'public/api/login';
