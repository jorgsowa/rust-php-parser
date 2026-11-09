===source===
<?php
const E = static::{'BAR'};
===errors <=8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
"static::" is not allowed in compile-time constants
===errors >=8.3===
"static::" is not allowed in compile-time constants
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '(' in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  "static::" is not allowed in compile-time constants in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
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
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 22
                    }
                  },
                  "member": {
                    "kind": {
                      "String": "BAR"
                    },
                    "span": {
                      "start": 25,
                      "end": 30
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 31
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 31
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
