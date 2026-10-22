===source===
<?php

enum Status
{
    /**
     * Uses shared enum behavior.
     */
    use EnumBehavior;

    case Active;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 12,
              "end": 18
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "EnumBehavior"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 79,
                        "end": 91
                      }
                    }
                  ],
                  "adaptations": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Uses shared enum behavior.\n     */",
                    "span": {
                      "start": 25,
                      "end": 70
                    }
                  }
                }
              },
              "span": {
                "start": 75,
                "end": 92
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 103,
                      "end": 109
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}
