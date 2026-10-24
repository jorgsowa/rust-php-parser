===source===
<?php
class A {
    public stdClass $x = null;
}
===errors===
Default value for property of type stdClass may not be null. Use the nullable type ?stdClass to allow null default value
===php_error===
PHP Fatal error:  Default value for property of type stdClass may not be null. Use the nullable type ?stdClass to allow null default value in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "stdClass"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 35
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 41,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
