===source===
<?php trait A {} class C { use A { m as x; }
===errors===
expected '}', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "A",
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Class": {
          "name": "C",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "m",
                          "new_modifier": null,
                          "new_name": "x"
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 42
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 27,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 17,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
===php_error===
PHP Parse error:  Unclosed '{' in Standard input code on line 1
