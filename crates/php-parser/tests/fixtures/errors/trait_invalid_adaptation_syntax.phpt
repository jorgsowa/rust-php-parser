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
                "end": 39,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40,
        "start_line": 1,
        "start_col": 6
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
                        "end": 57,
                        "start_line": 1,
                        "start_col": 55
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 51,
                "end": 72,
                "start_line": 1,
                "start_col": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 41,
        "end": 73,
        "start_line": 1,
        "start_col": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73,
    "start_line": 1,
    "start_col": 0
  }
}
