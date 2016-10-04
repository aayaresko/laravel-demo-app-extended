import { Resolve } from '@angular/router';
import { Injectable } from '@angular/core';
import { User } from './user';
import { UserService } from './user.service';

@Injectable()
export class UserResolveService implements Resolve<User> {

    public constructor(private service: UserService) {

    }

    public resolve(): Promise<User>|Promise<boolean> {
        // There is some problem with Observable in that scenario...
        return this.service
            .authenticated()
            .toPromise()
            .then((user) => {
                if (user) {
                    return user;
                } else {
                    return null;
                }
            });
    }
}