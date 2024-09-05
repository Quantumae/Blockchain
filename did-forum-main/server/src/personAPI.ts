interface Person
{
    id: string;
    name:string;
}

const persons: Person[] = [
    {
        id: "123456123456781234",
        name:"张三"
        
    },
    {
        id: "654321123456781234",
        name:"李四"
        
    },
    {
        id: "6543211234564321",
        name:"王五"
    },
    {
        id: "220724200407191811",
        name:"赵伟"
    },
];


async function fetchPersons()
{
    return persons ;
}

async function getPersonById(id: string): Promise<Person | undefined>
{
    return persons.find(person => person.id === id);
}

export { Person, persons, fetchPersons, getPersonById }