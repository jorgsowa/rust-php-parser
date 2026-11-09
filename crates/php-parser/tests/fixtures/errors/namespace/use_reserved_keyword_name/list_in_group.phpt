===source===
<?php
use A\{B, List};
===errors===
expected identifier, found 'list'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'List' (T_LIST), expecting '}' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "list", expecting "}" in Standard input code on line 2
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
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 13,
                  "end": 14
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 14
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "List"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 16,
                  "end": 20
                }
              },
              "alias": null,
              "span": {
                "start": 16,
                "end": 20
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
