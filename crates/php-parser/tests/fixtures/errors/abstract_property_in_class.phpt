===source===
<?php class Foo { abstract public string $bar; }
===errors===
properties cannot be abstract
===php_error <=8.2===
PHP Fatal error:  Properties cannot be declared abstract in Standard input code on line 1
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Only hooked properties may be declared abstract in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "bar",
                    "span": {
                      "start": 41,
                      "end": 45
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 34,
                          "end": 40
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 40
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
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
