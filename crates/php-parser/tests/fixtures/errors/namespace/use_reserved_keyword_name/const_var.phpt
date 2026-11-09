===source===
<?php
use const Var;
===errors===
expected identifier, found 'var'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Var' (T_VAR), expecting identifier (T_STRING) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "var", expecting identifier or fully qualified name or namespaced name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "Var"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 16,
                  "end": 19
                }
              },
              "alias": null,
              "span": {
                "start": 16,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
