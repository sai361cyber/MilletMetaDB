# MilletMeta DB

> A full-stack web application and curated database of 3,173 stress-responsive millet metabolites with functional annotations

![Copyright](https://img.shields.io/badge/Copyright-TNAU%202026-blue)
![Certificate](https://img.shields.io/badge/Cert-SW--2026022311-green)
![Stack](https://img.shields.io/badge/Stack-HTML%20%7C%20PHP%20%7C%20MySQL%20%7C%20JS-orange)
![Metabolites](https://img.shields.io/badge/Metabolites-3%2C173-teal)

---

## Overview

MilletMeta DB is a curated computational biology web application and database integrating experimentally validated and computationally predicted metabolite functions to support millet stress biology research.

**Copyright Certificate No.: SW-2026022311**
**Issued:** Copyright Office, Government of India — 29 January 2026
**Owner:** Tamil Nadu Agricultural University, Coimbatore

---

## Tech Stack

| Layer | Technology |
|---|---|
| Frontend | HTML5 · Tailwind CSS · JavaScript |
| Backend | PHP (MySQLi) |
| Database | MySQL |
| Search | Custom metabolite search pipeline |

---

## Features

- Browse 3,173 millet metabolite entries across multiple millet species
- Filter by stress type (Biotic / Abiotic), cultivar, plant part, and more
- Batch search for multiple metabolites simultaneously
- Detailed metabolite cards with bioactivity and expression context
- Species coverage: Sorghum, Pearl Millet, Finger Millet, Maize

---

## Project Structure

```
MilletMetaDB/
├── frontend/                              # HTML pages
│   ├── mhome.html                         # Home page
│   ├── about.html                         # About page
│   ├── tool.html                          # Batch search tool
│   ├── millet_details.html                # Sorghum/Pearl/Maize details
│   ├── finger_millet_details.html         # Finger millet details
│   ├── millet_results.html                # Search results display
│   ├── search_results.html                # Search output page
│   ├── sorghum_bls_details.html           # Sorghum - Bacterial Leaf Stripe
│   ├── sorghum_anthracnose_details.html   # Sorghum - Anthracnose
│   ├── sorghum_crown_rot_details.html     # Sorghum - Crown Rot
│   ├── sorghum_drought_details.html       # Sorghum - Drought
│   ├── sorghum_er_stress_details.html     # Sorghum - ER Stress
│   ├── sorghum_heat_details.html          # Sorghum - Heat Stress
│   ├── sorghum_nitrogen_deficiency_details.html
│   ├── sorghum_salinity.html              # Sorghum - Salinity
│   ├── finger_millet_neck_blast_details.html
│   └── finger_millet_salinity_details.html
├── backend/                               # PHP backend scripts
│   ├── fetch_metabolites.php              # Main metabolite query API
│   └── batch_search.php                   # Batch search API
├── docs/                                  # Documentation
│   └── copyright_certificate.pdf          # Govt. of India copyright certificate
└── README.md
```

---

## Database Statistics

| Feature | Details |
|---|---|
| Total Metabolite Entries | 3,173 |
| Millet Species | Sorghum, Pearl Millet, Finger Millet, Maize |
| Stress Categories | Biotic Stress, Abiotic Stress |
| Annotation Type | Stress-specific functional annotations |
| Expression Context | Included per entry |
| Literature References | Included per entry |

---

## Authors

| No. | Name | Role |
|---|---|---|
| 1 | Preethi Vishalini S | Author |
| 2 | **Sai Saran T** | Author |
| 3 | Dr. Jayakanthan M | Author / Mentor |
| 4 | Dr. Dhivyaprabha T.T | Author |
| 5 | Dr. Samyuktha S.M. | Author |

---

## Copyright Notice

This work is protected under the Copyright Act, 1957.
Certificate No.: SW-2026022311
Owner: Tamil Nadu Agricultural University
Unauthorized commercial use is strictly prohibited.

---

## Contact

**Sai Saran T** — M.Tech Computational Biology, IIIT Delhi
[![LinkedIn](https://img.shields.io/badge/LinkedIn-saisarant-blue)](https://linkedin.com/in/saisarant)
[![GitHub](https://img.shields.io/badge/GitHub-sai361cyber-black)](https://github.com/sai361cyber)
