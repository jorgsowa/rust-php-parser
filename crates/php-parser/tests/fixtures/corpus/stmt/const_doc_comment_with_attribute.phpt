===source===
<?php

/** @api */
#[SomeAttribute]
const VERSION = '1.0.0';
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes on constants' requires PHP 8.5 or higher
===errors 8.0-8.4===
'attributes on constants' requires PHP 8.5 or higher
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "VERSION",
              "span": {
                "start": 42,
                "end": 49
              }
            },
            "value": {
              "kind": {
                "String": "1.0.0"
              },
              "span": {
                "start": 52,
                "end": 59
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "SomeAttribute"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
                    "end": 34
                  }
                },
                "args": [],
                "span": {
                  "start": 21,
                  "end": 34
                }
              }
            ],
            "span": {
              "start": 42,
              "end": 59
            },
            "doc_comment": {
              "kind": "Doc",
              "text": "/** @api */",
              "span": {
                "start": 7,
                "end": 18
              }
            }
          }
        ]
      },
      "span": {
        "start": 36,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
