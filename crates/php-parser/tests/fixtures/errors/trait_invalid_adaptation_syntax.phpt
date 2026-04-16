===source===
<?php trait A { public function m() {} } class C { use A { m invalid; } }
===errors===
expected '::' or 'as', found identifier
expected identifier, found ';'
expected '::' or 'as', found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "A",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "m",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 38
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
                        "start": 55,
                        "end": 56
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 51,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 41,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected identifier "invalid", expecting "::" in Standard input code on line 1
