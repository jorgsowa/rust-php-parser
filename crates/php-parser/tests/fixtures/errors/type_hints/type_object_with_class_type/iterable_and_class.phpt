===source===
<?php
function d(): iterable|object|Closure {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type Closure|iterable|object contains both object and a class type, which is redundant
===errors 8.0-8.1===
Type Closure|iterable|object contains both object and a class type, which is redundant
===errors >=8.2===
Type Traversable|Closure|object|array contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Fatal error:  Type Closure|iterable|object contains both object and a class type, which is redundant in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Type Traversable|Closure|object|array contains both object and a class type, which is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "iterable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 28
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 29,
                        "end": 35
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 35
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Closure"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 36,
                        "end": 43
                      }
                    }
                  },
                  "span": {
                    "start": 36,
                    "end": 43
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 43
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
