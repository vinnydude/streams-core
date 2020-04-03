<?php

namespace Anomaly\Streams\Platform\Addon\FieldType;

use Illuminate\Support\Collection;
use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Database\Eloquent\Builder;
use Anomaly\Streams\Platform\Support\Facades\Hydrator;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Database\Eloquent\Relations\Relation;
use Anomaly\Streams\Platform\Ui\Traits\HasHtmlAttributes;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Traits\HasClassAttribute;

/**
 * Class FieldType
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FieldType extends Addon
{
    use HasHtmlAttributes;

    protected $installed = true;
    protected $enabled = true;

    /**
     * The cast type.
     *
     * @var string
     */
    protected $castType = null;

    /**
     * The disabled flag.
     *
     * @var bool
     */
    protected $disabled = false;

    /**
     * The readonly flag.
     *
     * @var bool
     */
    protected $readonly = false;

    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * The validation errors.
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Custom validators.
     * i.e. 'rule' => ['message', 'handler']
     *
     * @var array
     */
    protected $validators = [];

    /**
     * Custom validation messages.
     * i.e. 'rule' => ['rule', 'message']
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Configuration options.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The entry in context.
     *
     * @var null|EntryInterface|EloquentModel
     */
    protected $entry = null;

    /**
     * The field slug.
     *
     * @var null|string
     */
    protected $field = null;

    /**
     * The field value.
     *
     * @var null|mixed
     */
    protected $value = null;

    /**
     * The field label.
     *
     * @var null|string
     */
    protected $label = null;

    /**
     * The field warning.
     *
     * @var null|string
     */
    protected $warning = null;

    /**
     * The field's input locale.
     *
     * @var null|string
     */
    protected $locale = null;

    /**
     * The field instructions.
     *
     * @var null|string
     */
    protected $instructions = null;

    /**
     * The field placeholder.
     *
     * @var null
     */
    protected $placeholder = null;

    /**
     * Is the field required?
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Is the field hidden?
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * The field's input prefix.
     *
     * @var null|string
     */
    protected $prefix = null;

    /**
     * The save flag.
     *
     * @var bool
     */
    protected $save = true;

    /**
     * The field type class.
     *
     * @var null|string
     */
    protected $class = 'input';

    /**
     * The input type.
     *
     * @var string
     */
    protected $inputType = null;

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'string';

    /**
     * The database column length.
     *
     * @var null|integer
     */
    protected $columnLength = null;

    /**
     * The field input view.
     *
     * @var string
     */
    protected $inputView = 'admin::form/partials/input';

    /**
     * The field's filter input view.
     *
     * @var string
     */
    protected $filterView = 'admin::form/partials/filter';

    /**
     * The field wrapper view.
     *
     * @var string
     */
    protected $wrapperView = 'admin::form/partials/wrapper';

    /**
     * The presenter class.
     *
     * @var null|string
     */
    protected $presenter = FieldTypePresenter::class;

    /**
     * The schema class.
     *
     * @var null|string
     */
    protected $schema = FieldTypeSchema::class;

    /**
     * The parser class.
     *
     * @var null|string
     */
    protected $parser = null;

    /**
     * The query class.
     *
     * @var null|string
     */
    protected $query = null;

    /**
     * The field type criteria.
     *
     * @var null|string
     */
    protected $criteria;

    /**
     * Return a config value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return array_get($this->config, $key, $default);
    }

    /**
     * Get the disabled flag.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set the disabled flag.
     *
     * @param $disabled
     * @return $this
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get the readonly flag.
     *
     * @return bool
     */
    public function isReadonly()
    {
        return $this->readonly;
    }

    /**
     * Set the readonly flag.
     *
     * @param $readonly
     * @return $this
     */
    public function setReadonly($readonly)
    {
        $this->readonly = $readonly;

        return $this;
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set rules.
     *
     * @param  array $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Merge rules.
     *
     * @param  array $rules
     * @return $this
     */
    public function mergeRules(array $rules)
    {
        $this->rules = array_unique(array_merge($this->rules, $rules));

        return $this;
    }

    /**
     * Extend the rule set.
     *
     * @param  array $rules
     * @return array
     */
    public function extendRules(array $rules)
    {
        // Extend here.

        return $rules;
    }

    /**
     * Get the errors.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set errors.
     *
     * @param  array $errors
     * @return $this
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Return if the field
     * has errors or not.
     *
     * @return bool
     */
    public function hasErrors()
    {
        return !empty(array_filter($this->errors));
    }

    /**
     * Merge errors.
     *
     * @param  array $errors
     * @return $this
     */
    public function mergeErrors(array $errors)
    {
        $this->errors = array_unique(array_merge($this->errors, $errors));

        return $this;
    }

    /**
     * Get the validators.
     *
     * @return array
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * Merge validators.
     *
     * @param  array $validators
     * @return $this
     */
    public function mergeValidators(array $validators)
    {
        $this->validators = array_merge($this->validators, $validators);

        return $this;
    }

    /**
     * Get the messages.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Merge messages.
     *
     * @param  array $messages
     * @return $this
     */
    public function mergeMessages(array $messages)
    {
        $this->messages = array_merge($this->messages, $messages);

        return $this;
    }

    /**
     * Get the config options.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Merge configuration.
     *
     * @param  array $config
     * @return $this
     */
    public function mergeConfig(array $config)
    {
        $this->config = array_merge($this->config, $config);

        return $this;
    }

    /**
     * Set the field slug.
     *
     * @param  $field
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get a config value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function configGet($key, $default = null)
    {
        return array_get($this->config, $key, $default);
    }

    /**
     * Set a config value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function configSet($key, $value)
    {
        array_set($this->config, $key, $value);

        return $this;
    }

    /**
     * Get the entry.
     *
     * @return EntryInterface|EloquentModel
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set the entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get the field slug.
     *
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set the value.
     *
     * @param  $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Return if the type
     * has a value or not.
     *
     * @return bool
     */
    public function hasValue()
    {
        $value = $this->getValue();

        if ($value == '') {
            return false;
        }

        if ($value === null) {
            return false;
        }

        if ($value instanceof Collection) {
            return $value->isNotEmpty();
        }

        return true;
    }

    /**
     * Get the post value.
     *
     * @param  null $default
     * @return mixed
     */
    public function getPostValue($default = null)
    {
        $value = request()->post($this->getInputName(), $default);

        if ($value == '') {
            $value = null;
        }

        return $value;
    }

    /**
     * Get the value for repopulating
     * field after failed validation.
     *
     * @param  null $default
     * @return mixed
     */
    public function getRepopulateValue($default = null)
    {
        return $this->getPostValue($default);
    }

    /**
     * Return if any posted input exists.
     *
     * @return bool
     */
    public function hasPostedInput()
    {
        return request()->has(str_replace('.', '_', $this->getInputName()));
    }

    /**
     * Get the value to index.
     *
     * @return string
     */
    public function getSearchableValue()
    {
        $value = $this->getValue();

        if ($value instanceof Relation) {
            $value = $value->getResults();
        }

        if ($value instanceof EloquentModel) {
            $value = $value->toArray();
        }

        if (is_array($value)) {
            $value = json_encode($value);
        }

        return (string) $value;
    }

    /**
     * Get the value to validate.
     *
     * @param  null $default
     * @return mixed
     */
    public function getValidationValue($default = null)
    {
        $value = $this->getPostValue($default);

        if (is_array($value)) {
            array_filter($value) ?: $default;
        }

        return $value;
    }

    /**
     * Get the input value.
     *
     * @param  null $default
     * @return mixed
     */
    public function getInputValue($default = null)
    {
        return $this->getPostValue($default);
    }

    /**
     * Set the label.
     *
     * @param  $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the warning.
     *
     * @param $warning
     * @return $this
     */
    public function setWarning($warning)
    {
        $this->warning = $warning;

        return $this;
    }

    /**
     * Get the warning.
     *
     * @return null|string
     */
    public function getWarning()
    {
        return $this->warning;
    }

    /**
     * Set the instructions.
     *
     * @param  $instructions
     * @return $this
     */
    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;

        return $this;
    }

    /**
     * Get the instructions.
     *
     * @return string
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set the placeholder.
     *
     * @param $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Set the locale.
     *
     * @param  $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get the locale.
     *
     * @return null|string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Get the attributes.
     *
     * @param array $attributes
     * @return array
     */
    public function attributes(array $attributes = [])
    {
        return array_filter(
            array_merge(
                [
                    'value'       => $this->getValue(),
                    'name'        => $this->getInputName(),
                    'placeholder' => $this->getPlaceholder(),

                    'readonly' => $this->isReadonly() ? 'readonly' : '',
                    'disabled' => $this->isDisabled() ? 'disabled' : '',

                    'data-field'      => $this->getField(),
                    'data-field_name' => $this->getFieldName(),
                    'data-provides'   => $this->getNamespace(),

                    'class'           => $this->getClass(),
                    'id'              => $this->getInputName(),
                ],
                $this->getAttributes(),
                $attributes
            )
        );
    }

    /**
     * Get the attributes.
     *
     * @return array
     */
    public function wrapperAttributes()
    {
        $class = 'field';

        if ($this->hasErrors()) {
            $class .= ' -error';
        }

        $class .= " {$this->getFieldName()}-field";
        $class .= " {$this->getSlug()}-field_tye";

        if ($this->isHidden()) {
            $class .= " hidden";
        }

        return [
            'class' => $class,
        ];
    }

    /**
     * Get the suffix.
     *
     * @return null|string
     */
    public function getSuffix()
    {
        return $this->locale ? '_' . $this->locale : null;
    }

    /**
     * Set the save.
     *
     * @param  $save
     * @return $this
     */
    public function setSave($save)
    {
        $this->save = $save;

        return $this;
    }

    /**
     * Get the save flag.
     *
     * @return string
     */
    public function canSave()
    {
        return $this->save;
    }

    /**
     * Set the prefix.
     *
     * @param  $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the prefix.
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get the class.
     *
     * @return null|string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Set the hidden flag.
     *
     * @param  $hidden
     * @return $this
     */
    public function setHidden($hidden)
    {
        $this->hidden = ($hidden);

        return $this;
    }

    /**
     * Get the hidden flag.
     *
     * @return bool
     */
    public function isHidden()
    {
        return ($this->hidden);
    }

    /**
     * Set the required flag.
     *
     * @param  $required
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get the required flag.
     *
     * @return bool
     */
    public function isRequired()
    {
        return ($this->required);
    }

    /**
     * Get the name of the input.
     *
     * @return string
     */
    public function getInputName()
    {
        return "{$this->getPrefix()}{$this->getField()}{$this->getSuffix()}";
    }

    /**
     * Get the field name. This is the field
     * with the leading form suffix.
     *
     * @return string
     */
    public function getFieldName()
    {
        return "{$this->getPrefix()}{$this->getField()}";
    }

    /**
     * Get the column name.
     *
     * @return string
     */
    public function getColumnName()
    {
        return $this->field;
    }

    /**
     * Get the column name.
     *
     * @return string
     */
    public function getUniqueColumnName()
    {
        return $this->getColumnName();
    }

    /**
     * Get the column type.
     *
     * @return string
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

    /**
     * Get the column length.
     *
     * @return string
     */
    public function getColumnLength()
    {
        return $this->columnLength;
    }

    /**
     * Get the input type.
     *
     * @return string
     */
    public function getInputType()
    {
        return $this->inputType;
    }

    /**
     * Set the input view.
     *
     * @param  $view
     * @return $this
     */
    public function setInputView($view)
    {
        $this->inputView = $view;

        return $this;
    }

    /**
     * Get the input view.
     *
     * @return string
     */
    public function getInputView()
    {
        return $this->inputView;
    }

    /**
     * Render the input and wrapper.
     *
     * @param  array $payload
     * @return string
     */
    public function render($payload = [])
    {
        return view(
            $this->getWrapperView(),
            array_merge(
                $payload,
                [
                    'fieldType' => $this,
                ]
            )
        )->render();
    }

    /**
     * Set the filter view.
     *
     * @param  $view
     * @return $this
     */
    public function setFilterView($view)
    {
        $this->filterView = $view;

        return $this;
    }

    /**
     * Get the filter view.
     *
     * @return string
     */
    public function getFilterView()
    {
        return $this->filterView;
    }

    /**
     * Set the wrapper view.
     *
     * @param  $view
     * @return $this
     */
    public function setWrapperView($view)
    {
        $this->wrapperView = $view;

        return $this;
    }

    /**
     * Get the wrapper view.
     *
     * @return string
     */
    public function getWrapperView()
    {
        return $this->wrapperView;
    }

    /**
     * Return a new presenter instance.
     *
     * @return FieldTypePresenter
     */
    public function newPresenter()
    {
        if (!$this->presenter) {
            $this->presenter = get_class($this) . 'Presenter';
        }

        if (!class_exists($this->presenter)) {
            $this->presenter = FieldTypePresenter::class;
        }

        return app()->make($this->presenter, ['object' => $this]);
    }

    /**
     * Set the presenter class.
     *
     * @param $presenter
     * @return $this
     */
    public function setPresenter($presenter)
    {
        $this->presenter = $presenter;

        return $this;
    }

    /**
     * Get the schema.
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Set the schema.
     *
     * @param $schema
     * @return $this
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * Get the query utility.
     *
     * @return FieldTypeQuery
     */
    public function getQuery()
    {
        if (!$this->query) {
            $this->query = get_class($this) . 'Query';
        }

        if (!class_exists($this->query)) {
            $this->query = FieldTypeQuery::class;
        }

        return app()->make($this->query, ['fieldType' => $this]);
    }

    /**
     * Set the query class.
     *
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the criteria.
     *
     * @param Builder $query
     * @return FieldTypeQuery
     */
    public function criteria(Builder $query)
    {
        if (!$this->criteria) {
            $this->criteria = get_class($this) . 'Criteria';
        }

        if (!class_exists($this->criteria)) {
            $this->criteria = FieldTypeCriteria::class;
        }

        return app()->make(
            $this->criteria,
            [
                'fieldType' => $this,
                'query'     => $query,
            ]
        );
    }

    /**
     * Set the criteria class.
     *
     * @param $criteria
     * @return $this
     */
    public function setCriteria($criteria)
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * Render the input.
     *
     * @param array $payload
     * @return string
     */
    public function getInput(array $payload = [])
    {
        return view(
            $this->getInputView(),
            array_merge($payload, ['fieldType' => decorate($this)])
        )->render();
    }

    /**
     * Render the filter.
     *
     * @param array $payload
     * @return string
     */
    public function getFilter(array $payload = [])
    {
        return view(
            $this->getFilterView(),
            array_merge($payload, ['fieldType' => decorate($this)])
        )->render();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(Hydrator::dehydrate($this), [
            'attributes' => $this->attributes(),
        ]);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Return the rendering.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
