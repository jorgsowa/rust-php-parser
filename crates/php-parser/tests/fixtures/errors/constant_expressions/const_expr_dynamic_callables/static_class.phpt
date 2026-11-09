===source===
<?php
const E = static::m(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
"static" is not allowed in compile-time constants
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  "static" is not allowed in compile-time constants in Standard input code on line 2
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
                "CallableCreate": {
                  "kind": {
                    "StaticMethod": {
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
                      "method": {
                        "kind": {
                          "Identifier": "m"
                        },
                        "span": {
                          "start": 24,
                          "end": 25
                        }
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 30
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
