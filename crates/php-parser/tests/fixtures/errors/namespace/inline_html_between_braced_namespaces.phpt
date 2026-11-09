===source===
<?php
namespace A {}
?>
x<?php
namespace B {}
===errors===
No code may exist outside of namespace {}
===php_error===
PHP Fatal error:  No code may exist outside of namespace {} in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 21,
        "end": 24
      }
    },
    {
      "kind": {
        "InlineHtml": "x"
      },
      "span": {
        "start": 24,
        "end": 25
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 41,
              "end": 42
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 31,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
