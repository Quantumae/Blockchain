interface Movie
{
    id: number;
    title: string;
    description: string;
    pictureUrl: string;
    ageLimit: number;
    web: string
}

const movies: Movie[] = [
    {
        id: 1,
        title: "论坛首页",
        description: "欢迎来到我们的在线社区论坛首页！这里是一个集思广益、交流想法的中心地带。无论您是第一次访问还是我们的常客，都可以在这里找到最新的话题讨论、热门活动和社区公告。让我们共同营造一个充满活力和包容性的交流环境。",
        pictureUrl: "http://localhost:3000/movie/1.png",
        ageLimit: 0,
        web:"http://localhost/luntan/home.php"
    },
    {
        id: 2,
        title: "技术讨论区",
        description: "技术讨论区是技术爱好者的聚集地。在这里，您可以分享和探讨最新的技术趋势、编程难题、软件开发、人工智能、机器学习等话题。无论您是资深开发者还是编程新手，这里都有您展示才华和学习成长的空间。",
        pictureUrl: "http://localhost:3000/movie/2.png",
        ageLimit: 18,
        web:"http://localhost/luntan/tech.php"
    },
    {
        id: 3,
        title: "生活闲聊区",
        description: "生活闲聊区是您放松心情、分享日常生活点滴的理想场所。无论是旅行见闻、美食推荐、家庭趣事还是健康生活，这里都是您与他人分享和交流的好地方。让我们在这里找到共鸣，享受生活的每一刻。",
        pictureUrl: "http://localhost:3000/movie/3.png",
        ageLimit: 0,
        web:"http://localhost/luntan/life.php"
    },
    {
        id: 4,
        title: "娱乐八卦区",
        description: "想要追踪最新的娱乐新闻、电影评论、音乐榜单和明星八卦？娱乐八卦区是您的最佳选择。这里汇集了娱乐圈的热点话题和深度分析，无论您是狂热粉丝还是偶尔关注，都能在这里找到您感兴趣的内容。",
        pictureUrl: "http://localhost:3000/movie/4.png",
        ageLimit: 18,
        web:"http://localhost/luntan/entertainment.php"
    },
    {
        id: 5,
        title: "学习资源区",
        description: "学习资源区是知识的宝库，无论您是学生、教师还是终身学习者，都可以在这里找到丰富的学习材料和资源。分享学习心得、推荐优质课程、讨论学习方法，这里鼓励知识的分享和智慧的碰撞，助力每个人的学习旅程。",
        pictureUrl: "http://localhost:3000/movie/5.png",
        ageLimit: 18,
        web:"http://localhost/luntan/resources.php"
    },
];


async function fetchMovies()
{
    return movies;
}

async function getMovieById(id: number): Promise<Movie | undefined>
{
    return movies.find(movie => movie.id === id);
}

export { Movie, movies, fetchMovies, getMovieById }