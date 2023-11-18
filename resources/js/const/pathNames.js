export default class PathNames {
    static HOME = '/';
    static DASHBOARD = '/dashboard';
    static DM_DASHBOARD = '/dm-dashboard';
    static STARSHIP = '/starship';

    //subdirectories
    static DIVISION = '/division';
    
    static basePath = () => `\/${window.location.pathname.split(/[\/#?]/)[1]}`;
    static subdirectories = () => window.location.pathname.split(/[\/#?]/).slice(2);
}