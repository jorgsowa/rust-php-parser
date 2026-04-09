===source===
<?php trait T { #[Inject] public string $dep; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "T",
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "dep",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 39,
                          "start_line": 1,
                          "start_col": 33
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 39,
                      "start_line": 1,
                      "start_col": 33
                    }
                  },
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Inject"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 24,
                          "start_line": 1,
                          "start_col": 18
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 18,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 44,
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
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
