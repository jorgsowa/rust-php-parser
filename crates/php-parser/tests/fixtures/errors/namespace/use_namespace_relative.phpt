===source===
<?php
use namespace\A;
===errors===
expected name, found namespace-relative name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'namespace' (T_NAMESPACE), expecting identifier (T_STRING) or function (T_FUNCTION) or const (T_CONST) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected namespace-relative name "namespace\A" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Relative",
                "span": {
                  "start": 10,
                  "end": 21
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 21
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
