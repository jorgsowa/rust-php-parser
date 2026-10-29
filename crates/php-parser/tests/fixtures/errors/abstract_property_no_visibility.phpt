===source===
<?php class Foo { abstract string $bar; }
===errors <=8.2===
Properties cannot be declared abstract
===errors 8.3===
Cannot use the abstract modifier on a property
===errors >=8.4===
Only hooked properties may be declared abstract
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
                      "start": 34,
                      "end": 38
                    }
                  },
                  "modifiers": {
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
                          "start": 27,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 33
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
