export class Task {
    public constructor(public id: number,
                       public title: string,
                       public content: string,
                       public author_id: number,
                       public created_at: Date = new Date()) {

    }
}
