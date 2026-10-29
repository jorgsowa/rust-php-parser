===source===
<?php
enum E: int|null {}
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
Enum backing type must be int or string, ?int given
===errors 8.0===
'enums' requires PHP 8.1 or higher
Enum backing type must be int or string, ?int given
===errors >=8.1===
Enum backing type must be int or string, ?int given
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Enum backing type must be int or string, ?int given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "invalid_scalar_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 14,
                        "end": 17
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 17
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 22
                  }
                }
              ]
            },
            "span": {
              "start": 14,
              "end": 22
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
