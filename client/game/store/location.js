import Location from '~/model/Location';

export const state = () => ({
    locations: [
        new Location(1, 'Ciemny Las', 1300, 320)
    ]
});

export const getters = {
    getAll: (state) => () => {
        return state.locations;
    }
};

export const mutations = {

};


export const actions = {

};
