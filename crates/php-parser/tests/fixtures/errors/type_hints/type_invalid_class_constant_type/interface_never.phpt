===source===
<?php
interface I {
    const never E = 1;
}
===errors <=8.0===
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant I::E of type never
===errors 8.1-8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant I::E cannot have type never
===errors >=8.3===
Class constant I::E cannot have type never
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING), expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "E", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant I::E cannot have type never in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 35
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
