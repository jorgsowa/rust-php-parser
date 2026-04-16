===source===
<?php trait A {} class C { use A { insteadof; } }
===errors===
expected '::' or 'as', found ';'
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
                  "adaptations": []
                }
              },
              "span": {
                "start": 27,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 17,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "as" in Standard input code on line 1
