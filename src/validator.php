<?php
namespace App;

class Validator {
	public function validateRules(string $rules, string $param, $value): ?array
	{
		$rules = explode("|", $rules);
		$errors = [];

		foreach ($rules as $rule) {
			$rule = explode(":", $rule);
			$options = $rule[1] ?? null;
			$rule = $rule[0];

			switch ($rule) {
				case 'required':
					if (empty($value)) {
						array_push($errors, $this->getErrorMessage($rule, $param));
					}
					break;

				case 'positive':
					if ($value < 0) {
						array_push($errors, $this->getErrorMessage($rule, $param));
					}
					break;

				case 'numeric':
					if (!is_numeric($value)) {
						array_push($errors, $this->getErrorMessage($rule, $param));
					}
					break;

				case 'exactAs':
					if (!$this->isExactAs($value, $options)) {
						array_push($errors, $this->getErrorMessage($rule, $param, $options));
					}
					break;
				
				default:
					break;
			}
		}

		return count($errors) > 0 ? $errors : null;
	}

	public function getErrorMessage(string $rule, string $param, ?string $options = null)
	{
		$messages = [
			'required' => 'O parâmetro é obrigatório',
			'positive' => 'O parâmetro deve ser igual ou maior que zero',
			'numeric' => 'O parâmetro deve ser numérico',
			'exactAs' => 'Opções permitidas para esse parâmetro: :options',
		];

		if (isset($messages[$rule])) {
			if (!$options) {
				return $messages[$rule];
			} else {
				return str_replace(":options", $options, $messages[$rule]);
			}
		}

		return '400 Bad Request';
	}

	private function isExactAs($value, ?string $options): bool
	{
		if (strlen($options) > 0) {
			$options = explode(",", $options);
			return in_array($value, $options);
		}

		return false;
	}
}