import { Injectable } from '@angular/core';
import { Headers, Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { User } from './user';
import { appConfigData } from '../app-config-data';

@Injectable()
export class AuthorizationService {
    public headers = new Headers({ 'Content-Type': 'application/json', 'X-CSRF-TOKEN': appConfigData.csrf_token });
    public user: User;

    constructor(private http: Http) {
    }

    public getUserData(): Observable<any> {
        let url = `${appConfigData.api.endpoint_url}/user`;
        return this.http
            .get(url, { headers: this.headers })
            .map((response: Response) => {
                this.user = new User(response.json());
                return this.user;
            })
            .catch(this.handleError);
    }

    private handleError(error: any) {
        return Observable.throw(error);
    }
}
