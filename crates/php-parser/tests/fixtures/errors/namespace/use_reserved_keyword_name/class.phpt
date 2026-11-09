===source===
<?php
use Class;
===errors===
expected identifier, found 'class'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Class' (T_CLASS), expecting identifier (T_STRING) or function (T_FUNCTION) or const (T_CONST) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
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
                  "Class"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 15
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
