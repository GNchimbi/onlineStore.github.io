import { compileTemplate } from "vue/compiler-sfc"
import store from "../store"

const state = {
    all: []
}

const getters = {
    
    
}

const mutations = {
    setProducts(state, products) {
        state.all = products
    }
}

const actions = {
    async getAllProducts ({commit}){
        const response = await fetch("/product")
        const data = await response.json()
        commit('setProducts', data)
    }
}

export default {
    
    state,
    getters,
    mutations,
    actions
}