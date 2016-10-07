import {
    CanActivate,
    Router,
    ActivatedRouteSnapshot,
    RouterStateSnapshot,
    Route,
    CanLoad,
    CanActivateChild
} from '@angular/router';
import { Injectable } from '@angular/core';
import { Cookie } from 'ng2-cookies/ng2-cookies';
import { appConfigData } from '../app-config-data';

@Injectable()
export class AuthorizationGuard implements CanActivate, CanLoad, CanActivateChild {

    public constructor(private router: Router) {
    }

    public canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
        return this.runCheck();
    }

    public canActivateChild(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
        return this.runCheck();
    }

    public canLoad(route: Route): boolean {
        return this.runCheck();
    }

    private runCheck(): boolean {
        let accessToken = appConfigData.csrf_token;
        return (!accessToken || accessToken === '') ? false : true;
    }
}