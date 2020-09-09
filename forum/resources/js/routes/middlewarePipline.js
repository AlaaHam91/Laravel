function middlewarePipline(context, middleware, index) {
    const nextMiddleware = middleware[index];
    if (!nextMiddleware) {
        return context.next;
    }
    return () => {
        const nextPipline = middlewarePipline(context, middleware, index + 1);
        nextMiddleware({ ...context, next: nextPipline });
    };
}
export default middlewarePipline;
