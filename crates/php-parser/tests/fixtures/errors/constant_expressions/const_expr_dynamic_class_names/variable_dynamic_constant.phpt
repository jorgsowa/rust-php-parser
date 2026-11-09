===source===
<?php
const B = $foo::{'BAR'};
===errors <=8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
Dynamic class names are not allowed in compile-time class constant references
===errors >=8.3===
Dynamic class names are not allowed in compile-time class constant references
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '(' in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Dynamic class names are not allowed in compile-time class constant references in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
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
                      "Variable": "foo"
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "member": {
                    "kind": {
                      "String": "BAR"
                    },
                    "span": {
                      "start": 23,
                      "end": 28
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
