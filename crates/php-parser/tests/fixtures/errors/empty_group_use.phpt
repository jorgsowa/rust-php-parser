===source===
<?php use A\B\{};
===errors===
expected at least one import in group use, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting identifier (T_STRING) or function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}", expecting identifier or namespaced name or "function" or "const" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": []
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
