===source===
<?php
const A = $foo::BAR;
===errors===
Dynamic class names are not allowed in compile-time class constant references
===php_error===
PHP Fatal error:  Dynamic class names are not allowed in compile-time class constant references in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
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
                      "Identifier": "BAR"
                    },
                    "span": {
                      "start": 22,
                      "end": 25
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
