<template>
  <div>
    This is creator page
  </div>
</template>

<script>
export default {
  middleware: 'authenticated',
  asyncData({
    isDev,
    route,
    store,
    env,
    params,
    query,
    req,
    res,
    redirect,
    error
  }) {
    redirect("/creator/" + params.userId + "/collections");
    return {};
  }
};
</script>
