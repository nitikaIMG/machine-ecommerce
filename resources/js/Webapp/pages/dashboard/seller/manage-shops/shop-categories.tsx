import * as React from 'react';
import { t } from '@utils/helpers';
import { useCategoryListQuery } from '@root/rest/product/categoy.query';
import { useUpdateCategoryMutation } from '@root/rest/user/seller-products.query';
import { LoadingSpinner } from '@root/components/ui/loading-spinner';
import { ProductCategory } from '@root/types/models';
import { filter } from 'lodash';

type ShopCategoriesType = {
    shop_id: primary_id
};

const ShopCategories: React.FC<ShopCategoriesType> = ({ shop_id }) => {
    
    const ref = React.useRef(0);

    const [categories, isCategoriesLoading] = useCategoryListQuery({ shop_id });
    const [checkedCategories, setCheckedCategories] = React.useState<Array<primary_id>>([]);

    const { mutate: updateCategory, isLoading: isCategoryUpdating } = useUpdateCategoryMutation();

    React.useEffect(() => {
        updateCategory({
            categories: checkedCategories, shop_id
        });
    }, [checkedCategories.length]);

    // run only once and update local state with checkedCategories
    React.useEffect(() => {
        if( ref.current == 1 || !categories ) return;

        setCheckedCategories(
            categories.filter(c => c.shop_serves)?.map(c => c.id) ?? []
        );

        ref.current = 1;

    }, [categories]);

    const onCategoryUpdate = (e: React.ChangeEvent<HTMLInputElement>) => {
        const isChecked = e.target.checked;
        const value = e.target.value;

        setCheckedCategories(
            isChecked
                ? [...checkedCategories, value]
                : checkedCategories.filter(c => c != value)
        );
    };

    if (isCategoriesLoading) {
        return <LoadingSpinner />;
    }

    return (
        <div className="card p30" id="myTab">
            <div className="header">
                <h6 className="fw-bold">{t('Categories')}</h6>

                <div className="row">
                    {categories?.map(category => (
                        <div key={category.id} className="col">
                            <div className="card">
                                <label htmlFor={`e-d-${category.id}`} className="card-header">
                                    <input
                                        value={category.id}
                                        onChange={onCategoryUpdate}
                                        id={`e-d-${category.id}`}
                                        type="checkbox"
                                        checked={category.shop_serves}
                                    />
                                </label>
                                <div className="card-body">
                                    <b>{category.title}</b>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
};

export default ShopCategories;