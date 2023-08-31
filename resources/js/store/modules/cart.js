
const state = {
    items: [],
}

const getters = {
    getProductsInCart(state, getters, rootState){
        return state.items.map(({id, quantity}) => {
            const products = rootState.products.all.find(product => product.id === id)
            console.log(products)
            return {
                id: products.id,
                name: products.name,
                price: products.price,
                quantity
            }
        })
    },

    cartTotal(state, getters){
        var total = 0
        const products = getters.getProductsInCart
        products.forEach(product => {
            total += (product.price * product.quantity)
        })
        return total
    },
    cartTotalQuantity(state, getters){
        var total = 0
        const products = getters.getProductsInCart
        products.forEach(product => {
            total += product.quantity
        })
        return total
    }
}

const actions = {
    addItemsToCart({commit, state}, product) {
      const cartExist = state.items.filter(item => item.id === product.id)
      if(cartExist.length){
        console.log('Ooh yeah it is exist')
        commit('incrementCart', product)
      }
      else{
        console.log('not bad we should add it')
        commit('pushToCart', product)
      }
    }
}

const  mutations = {
    setItemsInCart({state}, items){
        state.items = items
    },

    incrementCart(state, product){
        var item = state.items.find(item => item.id === product.id)
        item.quantity += product.quantity
    },

    pushToCart(state, product){
        state.items.push({id: product.id, quantity: product.quantity})
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}