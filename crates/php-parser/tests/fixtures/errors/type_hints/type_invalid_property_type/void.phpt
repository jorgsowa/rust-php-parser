===source===
<?php
class A {
    public void $a;
}
===errors===
Property A::$a cannot have type void
===php_error===
PHP Fatal error:  Property A::$a cannot have type void in Standard input code on line 3
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
                    "name": "a",
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 31
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 31
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 34
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
