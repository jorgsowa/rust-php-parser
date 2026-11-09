===source===
<?php
trait T {
    public void $h;
}
===errors===
Property T::$h cannot have type void
===php_error===
PHP Fatal error:  Property T::$h cannot have type void in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
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
