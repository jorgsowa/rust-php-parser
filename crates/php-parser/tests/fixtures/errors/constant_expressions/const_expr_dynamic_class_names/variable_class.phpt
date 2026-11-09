===source===
<?php
const C = $foo::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
(expression)::class cannot be used in constant expressions
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  (expression)::class cannot be used in constant expressions in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Variable": "foo"
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 22,
                      "end": 27
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
