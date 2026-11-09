===source===
<?php
const W = Foo::{$c};
===errors <=8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
Constant expression contains invalid operations
===errors >=8.3===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '(' in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "W",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ClassConstAccessDynamic": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 19
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 19
                    }
                  },
                  "member": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 22,
                      "end": 24
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
