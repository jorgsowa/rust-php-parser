===source===
<?php
enum E
{
    public \Foo\Bar $a;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Enum E cannot include properties
===errors >=8.1===
Enum E cannot include properties
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Enums may not include properties in Standard input code on line 4
===php_error >=8.2===
PHP Fatal error:  Enum E cannot include properties in Standard input code on line 4
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
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 35,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Foo",
                          "Bar"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 26,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 37
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
